/*
 * Copyright (c) Enalean, 2020 - present. All Rights Reserved.
 *
 * This file is a part of Tuleap.
 *
 * Tuleap is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Tuleap is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
 */

import { extractNameAndShortnameFromXmlFile } from "./xml-data-extractor";

describe("xml-data-extractor", () => {
    it("throws an error when the file is not a valid xml file", async () => {
        expect.assertions(1);

        const file = new File(["I am not a xml file"], "message.txt");

        await expect(extractNameAndShortnameFromXmlFile(file)).rejects.toEqual(
            "The provided XML file does not provide any name and/or shortname"
        );
    });

    it("throws an error when the file does not contain a tracker name", async () => {
        expect.assertions(1);

        const file = new File(
            [`<tracker instantiate_for_new_projects="1"></tracker>`],
            "tracker.xml"
        );

        await expect(extractNameAndShortnameFromXmlFile(file)).rejects.toEqual(
            "The provided XML file does not provide any name and/or shortname"
        );
    });

    it("throws an error when the file does not contain a tracker shortname", async () => {
        expect.assertions(1);

        const file = new File(
            [
                `<tracker instantiate_for_new_projects="1">
                    <name>Bugs</name>
                </tracker>`
            ],
            "tracker.xml"
        );

        await expect(extractNameAndShortnameFromXmlFile(file)).rejects.toEqual(
            "The provided XML file does not provide any name and/or shortname"
        );
    });

    it("throws an error when the file contains an empty tracker name", async () => {
        expect.assertions(1);

        const file = new File(
            [
                `<tracker instantiate_for_new_projects="1">
                    <name></name>
                    <item_name>bugs_tracker</item_name>
                </tracker>`
            ],
            "tracker.xml"
        );

        await expect(extractNameAndShortnameFromXmlFile(file)).rejects.toEqual(
            "The provided XML file does not provide any name and/or shortname"
        );
    });

    it("throws an error when the file contains an empty tracker shortname", async () => {
        expect.assertions(1);

        const file = new File(
            [
                `<tracker instantiate_for_new_projects="1">
                    <name>Bugs</name>
                    <item_name></item_name>
                </tracker>`
            ],
            "tracker.xml"
        );

        await expect(extractNameAndShortnameFromXmlFile(file)).rejects.toEqual(
            "The provided XML file does not provide any name and/or shortname"
        );
    });

    it("otherwise it returns the tracker's name and shortname", async () => {
        const file = new File(
            [
                `<tracker instantiate_for_new_projects="1">
                    <name>Bugs</name>
                    <item_name>bugs_tracker</item_name>
                </tracker>`
            ],
            "tracker.xml"
        );

        const result = await extractNameAndShortnameFromXmlFile(file);

        expect(result).toEqual({
            name: "Bugs",
            shortname: "bugs_tracker"
        });
    });
});
